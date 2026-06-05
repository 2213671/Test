package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.CurrentUser;
import com.example.pos_hcsdl.dto.LoginRequest;
import com.example.pos_hcsdl.dto.RegisterRequest;
import com.example.pos_hcsdl.service.AuthService;
import io.swagger.v3.oas.annotations.tags.Tag;
import jakarta.servlet.http.HttpServletResponse;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.Map;

@Tag(name = "1. Auth Management")
@RestController
@RequestMapping("/auth")
public class AuthController {

    @Autowired
    private AuthService authService;

    @PostMapping("/login")
    public void login(@RequestBody LoginRequest loginRequest, HttpServletResponse response) {
        Map<String, String> tokens = authService.login(loginRequest);
        response.addHeader("Set-Cookie",
                "accessToken=" + tokens.get("accessToken") +
                        "; Path=/; Max-Age=" + (24 * 60 * 60) + "; SameSite=Lax"
        );

        response.addHeader("Set-Cookie",
                "refreshToken=" + tokens.get("refreshToken") +
                        "; Path=/; Max-Age=" + (7 * 24 * 60 * 60) + "; SameSite=Lax"
        );

        response.addHeader("Set-Cookie",
                "sub=" + tokens.get("sub") +
                        "; Path=/; Max-Age=" + (7 * 24 * 60 * 60) + "; SameSite=Lax"
        );
    }

    @PostMapping("/refresh")
    public Map<String, String> refresh(@CookieValue(name = "refreshToken", required = false) String refreshToken,
                                       HttpServletResponse response) {
        String accessToken = authService.refreshAccessToken(refreshToken);
        response.addHeader("Set-Cookie",
                "accessToken=" + accessToken +
                        "; Path=/; Max-Age=60; SameSite=Lax"
        );
        return Map.of("accessToken", accessToken);
    }

    @GetMapping("/current-user")
    public CurrentUser getCurrentUser(
            @RequestHeader(name = "Authorization", required = false) String tokenHeader,
            @CookieValue(name = "accessToken", required = false) String accessToken
    ) {
        String token = null;

        if (tokenHeader != null && tokenHeader.startsWith("Bearer ")) {
            token = tokenHeader.substring(7);
        } else if (accessToken != null) {
            token = accessToken;
        }

        return authService.getUserFromToken(token);
    }
}

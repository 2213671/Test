package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.CurrentUser;
import com.example.pos_hcsdl.dto.LoginRequest;
import com.example.pos_hcsdl.dto.RegisterRequest;
import com.example.pos_hcsdl.entity.Role;
import com.example.pos_hcsdl.entity.User;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.exception.UnauthorizedException;
import com.example.pos_hcsdl.mapper.UserMapper;
import com.example.pos_hcsdl.repository.RoleRepository;
import com.example.pos_hcsdl.repository.UserRepository;
import com.example.pos_hcsdl.security.JwtService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.HashMap;
import java.util.Map;

@Service
public class AuthService {

    @Autowired
    private UserRepository userRepository;

    @Autowired
    private RoleRepository roleRepository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @Autowired
    private JwtService jwtService;

    @Autowired
    private UserMapper userMapper;

    public Map<String, String> login(LoginRequest loginRequest) {
        User user = userRepository.findByUsername(loginRequest.getUsername())
                .orElseThrow(() -> new BadRequestException("Username Not Found"));
        if (!passwordEncoder.matches(loginRequest.getPassword(), user.getPassword())) {
            throw new BadRequestException("Invalid credentials");
        }

        String token = jwtService.generateToken(user);
        String refreshToken = jwtService.generateRefreshToken(user);

        Map<String, String> tokens = new HashMap<>();
        tokens.put("accessToken", token);
        tokens.put("refreshToken", refreshToken);
        tokens.put("sub", user.getId());
        return tokens;
    }

    public String refreshAccessToken(String refreshToken) {
        String username = jwtService.extractUsername(refreshToken);
        String userId = jwtService.extractUserId(refreshToken);
        if (jwtService.validateToken(refreshToken, username)) {
            User user = userRepository.findById(userId).orElseThrow(() -> new BadRequestException("Username Not Found"));
            return jwtService.generateToken(user);
        }
        throw new RuntimeException("Invalid refresh token");
    }

    public CurrentUser getUserFromToken(String token) {
        if (token == null) {
            throw new UnauthorizedException("Unauthenticated");
        }
        String username = jwtService.extractUsername(token);
        String userId = jwtService.extractUserId(token);
        if (jwtService.validateToken(token, username)) {
            return userMapper.getCurrentUser(userRepository.findById(userId)
                    .orElseThrow(() -> new BadRequestException("User not found")));
        }
        return null;
    }
}

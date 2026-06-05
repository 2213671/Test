package com.example.pos_hcsdl.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;

@Configuration
@EnableWebSecurity
public class SecurityConfig {

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }


    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
                .csrf(csrf -> csrf.disable()) // tắt CSRF
                .authorizeHttpRequests(auth -> auth
                                .requestMatchers("/auth/**", "/swagger-ui/**", "/v3/api-docs/**").permitAll() // cho phép các API auth, swagger
//                        .anyRequest().authenticated()
                                .anyRequest().permitAll()
                )

                .formLogin(form -> form.disable()) // tắt form login mặc định
                .httpBasic(basic -> basic.disable()); // tắt HTTP Basic Auth
        return http.build();
    }
}

package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.time.LocalDateTime;

@Data
public class RestaurantResponse {
    private String id;
    private String name;
    private String description;
    private String address;
    private String phone;
    private String email;
    private String imageUrl;
    private LocalDateTime createdAt;
}

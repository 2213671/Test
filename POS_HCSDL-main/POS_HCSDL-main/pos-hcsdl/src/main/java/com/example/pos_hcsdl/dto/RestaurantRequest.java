package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class RestaurantRequest {
    private String username;
    private String password;
    private String name;
    private String description;
    private String address;
    private String phone;
    private String email;
    private String imageUrl;
}

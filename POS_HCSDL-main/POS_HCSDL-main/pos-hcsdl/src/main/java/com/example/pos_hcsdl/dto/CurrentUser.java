package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class CurrentUser {
    private String id;
    private String username;
    private String phone;
    private String email;
    private String address;
    private String roleName;
    private String imageUrl;
    private String restaurantId;
}

package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class StaffRequest {
    private String username;
    private String password;
    private String email;
    private String address;
    private String phone;
    private String imageUrl;
}

package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class StaffResponse {
    private String id;
    private String username;
    private String email;
    private String phone;
    private String address;
    private String imageUrl;
    private String roleName;
}

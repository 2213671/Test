package com.example.pos_hcsdl.dto;

import com.example.pos_hcsdl.enums.Status;
import lombok.Data;

@Data
public class MenuResponse {
    private String id;
    private String name;
    private String description;
    private String status;
    private String restaurantId;
}

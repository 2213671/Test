package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class OptionResponse {
    private String id;
    private String name;
    private Boolean required;
    private String status;
    private String restaurantId;
    private BigDecimal price;
}

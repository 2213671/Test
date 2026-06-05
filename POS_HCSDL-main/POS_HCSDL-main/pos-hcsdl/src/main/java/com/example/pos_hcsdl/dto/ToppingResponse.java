package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class ToppingResponse {
    private String id;
    private String name;
    private Integer maxQuantity;
    private String status;
    private String restaurantId;
    private BigDecimal price;
}

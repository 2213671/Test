package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class ToppingRequest {
    private String name;
    private Integer maxQuantity;
    private BigDecimal price;
}

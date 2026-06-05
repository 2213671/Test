package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class OptionRequest {
    private String name;
    private Boolean required;
    private BigDecimal price;
}

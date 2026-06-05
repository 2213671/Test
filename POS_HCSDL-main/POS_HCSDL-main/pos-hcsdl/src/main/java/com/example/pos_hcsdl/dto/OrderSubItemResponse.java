package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class OrderSubItemResponse {
    private String id;
    private String name;
    private BigDecimal price;
    private Long quantity;
    private String itemType;
    private String itemId;
}

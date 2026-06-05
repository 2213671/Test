package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class TableResponse {
    private String id;
    private String name;
    private Integer idx;
    private Integer customerCount;
    private BigDecimal totalPrice;
    private Long totalItem;
    private String status;
    private String OrderId;
    private String restaurantId;
}

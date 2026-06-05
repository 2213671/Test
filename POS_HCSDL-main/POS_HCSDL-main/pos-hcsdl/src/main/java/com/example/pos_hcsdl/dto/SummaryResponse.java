package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class SummaryResponse {
    private Long numRestaurant;
    private BigDecimal customerCount;
    private BigDecimal totalItem;
    private BigDecimal finalAmount;

    public SummaryResponse(Long numRestaurant, BigDecimal customerCount, BigDecimal totalItem, BigDecimal finalAmount) {
        this.numRestaurant = numRestaurant;
        this.customerCount = customerCount;
        this.totalItem = totalItem;
        this.finalAmount = finalAmount;
    }
}

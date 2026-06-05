package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class SummaryRestaurantResponse {
    private BigDecimal customerCount;
    private BigDecimal totalItem;
    private BigDecimal finalAmount;

    public SummaryRestaurantResponse(  BigDecimal customerCount, BigDecimal totalItem, BigDecimal finalAmount) {
        this.customerCount = customerCount;
        this.totalItem = totalItem;
        this.finalAmount = finalAmount;
    }
}

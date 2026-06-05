package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;

@Data
public class PaymentTotalRequest {
    private String id;
    private String name;
    private BigDecimal amount;
}

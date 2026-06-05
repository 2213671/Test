package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class PaymentMethodRequest {
    private String name;
    private String code;
}

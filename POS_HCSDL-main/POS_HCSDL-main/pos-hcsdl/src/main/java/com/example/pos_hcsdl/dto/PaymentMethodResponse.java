package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class PaymentMethodResponse {
    private String id;
    private String name;
    private String code;
    private String status;
    private String restaurantId;
}

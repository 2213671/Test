package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.util.List;

@Data
public class PaymentRequest {
    private String orderId;
    private List<PaymentTotalRequest> paymentMethods;
    private String promotionId;
}

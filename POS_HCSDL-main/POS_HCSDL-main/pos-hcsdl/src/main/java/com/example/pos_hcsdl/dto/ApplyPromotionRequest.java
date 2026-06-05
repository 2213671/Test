package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class ApplyPromotionRequest {
    private String orderId;
    private String promotionId;
}

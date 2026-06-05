package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.time.LocalDateTime;

@Data
public class PromotionOrderResponse {
    private String id;
    private String promotionId;
    private String promotionName;
    private String promotionValue;
    private String promotionType;
    private LocalDateTime applyAt;
    private String applyOrderType;
    private BigDecimal amountAfterPromotion;
    private BigDecimal amountBeforePromotion;
}

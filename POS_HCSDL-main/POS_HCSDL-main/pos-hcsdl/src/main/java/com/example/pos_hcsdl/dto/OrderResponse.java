package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.time.LocalDateTime;
import java.util.List;

@Data
public class OrderResponse {
    private String id;
    private String code;
    private String tableId;
    private String tableName;
    private String orderStatus;
    private List<OrderItemDTO> orderItems;
    private String shiftId;
    private String creatorId;
    private String creatorName;
    private BigDecimal totalPrice;
    private Long totalItem;
    private BigDecimal amountDiscount;
    private Integer customerCount;
    private BigDecimal finalAmount;
    private BigDecimal amountReceivedFromCustomer;
    private BigDecimal amountChangeGivenToCustomer;
    private PromotionOrderResponse promotion;
    private LocalDateTime createdAt;
    private LocalDateTime updatedAt;
}

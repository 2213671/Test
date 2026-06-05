package com.example.pos_hcsdl.dto;

import jakarta.persistence.Column;
import lombok.Data;

import java.math.BigDecimal;
import java.sql.Timestamp;
import java.time.LocalDateTime;
import java.util.List;

@Data
public class OrderItemHistoryResponse {
    private String id;
    private String name;
    private BigDecimal price;
    private Long quantity;
    private String itemType;
    private String orderHistoryStatus;
    private String itemId;
    private String requestId;
    private LocalDateTime orderAt;
    private String imageUrl;
    private List<OrderSubItemHistoryResponse> subItems;

    public OrderItemHistoryResponse(String id, String name, BigDecimal price, Long quantity, String itemType, String orderHistoryStatus, String itemId, String requestId, Timestamp orderAt, String imageUrl) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.quantity = quantity;
        this.itemType = itemType;
        this.orderHistoryStatus = orderHistoryStatus;
        this.itemId = itemId;
        this.requestId = requestId;
        this.orderAt = orderAt != null ? orderAt.toLocalDateTime() : null;
        this.imageUrl = imageUrl;
    }
}

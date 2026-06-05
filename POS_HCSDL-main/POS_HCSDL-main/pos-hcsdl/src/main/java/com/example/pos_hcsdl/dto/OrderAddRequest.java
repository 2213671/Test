package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.util.List;

@Data
public class OrderAddRequest {
    private String orderId;
    private List<OrderItemRequest> items;
}

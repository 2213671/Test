package com.example.pos_hcsdl.dto;

import lombok.Data;

@Data
public class OrderItemBaseRequest {
    private String itemId;
    private Long quantity;
    private String itemType;
}

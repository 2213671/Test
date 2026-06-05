package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.util.List;

@Data
public class OrderItemResponse {
    private String id;
    private String name;
    private BigDecimal price;
    private Long quantity;
    private String imageUrl;
    private String itemType;
    private String itemId;
    private String menuId;
    private List<OrderSubItemResponse> subItems;
}

package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.util.List;

@Data
public class OrderRequest {
    private String tableId;
    private String shiftId;
    private String creatorId;
    private Integer customerCount;
    private List<OrderItemRequest> items;
}

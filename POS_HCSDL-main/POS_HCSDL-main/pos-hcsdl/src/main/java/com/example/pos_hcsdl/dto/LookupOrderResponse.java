package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.util.List;

@Data
public class LookupOrderResponse {
    private Integer pageNo;
    private Integer pageSize;
    private long totalElements;
    private long totalPages;
    private List<OrderResponse> content;
}

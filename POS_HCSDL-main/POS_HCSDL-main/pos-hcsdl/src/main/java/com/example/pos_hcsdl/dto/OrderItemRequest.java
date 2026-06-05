package com.example.pos_hcsdl.dto;

import lombok.Data;
import lombok.EqualsAndHashCode;

import java.util.List;

@EqualsAndHashCode(callSuper = true)
@Data
public class OrderItemRequest extends OrderItemBaseRequest{
    private List<OrderItemBaseRequest> subItems;
}

package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.OrderItemRequest;
import com.example.pos_hcsdl.dto.OrderItemResponse;
import com.example.pos_hcsdl.dto.OrderResponse;
import com.example.pos_hcsdl.dto.OrderSubItemResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderSubItem;
import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.service.OrderSubItemService;
import org.mapstruct.AfterMapping;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.MappingTarget;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.ArrayList;
import java.util.List;

@Mapper(componentModel = "spring")
public abstract class OrderItemMapper implements BaseResponseMapper<OrderItem, OrderItemResponse> {

    @Autowired
    protected OrderSubItemService orderSubItemService;
}

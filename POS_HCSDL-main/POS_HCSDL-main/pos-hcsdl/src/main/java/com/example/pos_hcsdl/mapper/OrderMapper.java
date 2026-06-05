package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.OrderItemDTO;
import com.example.pos_hcsdl.dto.OrderItemResponse;
import com.example.pos_hcsdl.dto.OrderResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.repository.OrderRepository;
import com.example.pos_hcsdl.service.OrderItemService;
import com.example.pos_hcsdl.service.PromotionOrderService;
import org.mapstruct.AfterMapping;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.MappingTarget;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.List;

@Mapper(componentModel = "spring")
public abstract class OrderMapper implements BaseResponseMapper<Order, OrderResponse> {

    @Autowired
    protected OrderRepository orderRepository;

    @Autowired
    private PromotionOrderService  promotionOrderService;

    @Override
    @Mapping(target = "creatorId", source = "creator.id")
    @Mapping(target = "creatorName", source = "creator.username")
    @Mapping(target = "shiftId", source = "shift.id")
    @Mapping(target = "orderItems", ignore = true)
    public abstract OrderResponse entityToResponse(Order order);
}

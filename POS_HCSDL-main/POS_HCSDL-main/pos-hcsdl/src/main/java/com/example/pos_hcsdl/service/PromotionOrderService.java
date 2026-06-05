package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.PromotionOrderResponse;
import com.example.pos_hcsdl.dto.PromotionRequest;
import com.example.pos_hcsdl.dto.PromotionResponse;
import com.example.pos_hcsdl.entity.*;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.MenuMapper;
import com.example.pos_hcsdl.mapper.PromotionMapper;
import com.example.pos_hcsdl.mapper.PromotionOrderMapper;
import com.example.pos_hcsdl.repository.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class PromotionOrderService {
    @Autowired
    private PromotionOrderRepository promotionOrderRepository;

    @Autowired
    private OrderRepository  orderRepository;

    @Autowired
    private PromotionOrderMapper promotionOrderMapper;

    public PromotionOrderResponse findPromotionOrderByOrder(String orderId) {
        Order order = orderRepository.findById(orderId)
                .orElseThrow(() -> new BadRequestException("Order not found"));

        return promotionOrderMapper.getPromotionOrderResponse(promotionOrderRepository.findByOrder(order)
                .orElse(null));
    }
}

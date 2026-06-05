package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.OrderItemResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderSubItem;
import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.mapper.OrderItemMapper;
import com.example.pos_hcsdl.repository.OrderItemRepository;
import com.example.pos_hcsdl.repository.ProductRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

@Service
public class OrderItemService {

    @Autowired
    private OrderItemRepository orderItemRepository;

    @Autowired
    private OrderItemMapper orderItemMapper;

    @Autowired
    private ProductRepository  productRepository;

    public List<OrderItemResponse> findOrderItemsByOrderId(String orderId) {
        List<OrderItemResponse>  orderItemResponses = orderItemMapper.entityToResponseList(orderItemRepository.findAllByOrderIdOrderByCreatedAtDesc(orderId));

        return orderItemResponses.stream().peek((orderItemResponse) -> {
            Product product = productRepository.findById(orderItemResponse.getItemId())
                    .orElseThrow(() -> new RuntimeException("Product not found"));
            orderItemResponse.setImageUrl(product.getImageUrl());
            orderItemResponse.setMenuId(product.getMenu().getId());
        }).toList();
    }

    public OrderItem createOrderItem(Long quantity, String itemType, String itemId, Order order) {
        Product product = productRepository.findById(itemId)
                .orElseThrow(() -> new RuntimeException("Product not found"));

        OrderItem orderItem = new OrderItem();
        orderItem.setName(product.getName());
        orderItem.setPrice(product.getPrice());
        orderItem.setQuantity(quantity);
        orderItem.setOrder(order);
        orderItem.setItemType(itemType);
        orderItem.setItemId(itemId);

        return orderItemRepository.save(orderItem);
    }

    public List<OrderItemResponse> findOrderItemsByOrderIdAndProductId(String orderId, String productId) {
        return orderItemMapper.entityToResponseList(orderItemRepository.findAllByOrderIdAndItemIdOrderByCreatedAtDesc(orderId, productId));
    }

}

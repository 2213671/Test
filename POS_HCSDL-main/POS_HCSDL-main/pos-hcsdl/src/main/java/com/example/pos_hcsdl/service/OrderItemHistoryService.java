package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.OrderItemHistoryResponse;
import com.example.pos_hcsdl.dto.OrderItemResponse;
import com.example.pos_hcsdl.dto.OrderSubItemHistoryResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderItemHistory;
import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.OrderItemHistoryMapper;
import com.example.pos_hcsdl.mapper.OrderItemMapper;
import com.example.pos_hcsdl.mapper.OrderSubItemHistoryMapper;
import com.example.pos_hcsdl.repository.*;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class OrderItemHistoryService {

    @Autowired
    private OrderItemHistoryRepository orderItemHistoryRepository;

    @Autowired
    private OrderSubItemHistoryRepository orderSubItemHistoryRepository;

    @Autowired
    private ProductRepository productRepository;

    @Autowired
    private OrderRepository orderRepository;

    @Autowired
    private OrderItemHistoryMapper orderItemHistoryMapper;

    @Autowired
    private OrderSubItemHistoryMapper orderSubItemHistoryMapper;

    public OrderItemHistory createOrderItemHistory(Long quantity, String itemType, String itemId, Order order, String status) {
        Product product = productRepository.findById(itemId)
                .orElseThrow(() -> new RuntimeException("Product not found"));

        OrderItemHistory orderItemHistory = new OrderItemHistory();
        orderItemHistory.setName(product.getName());
        orderItemHistory.setPrice(product.getPrice());
        orderItemHistory.setQuantity(quantity);
        orderItemHistory.setOrder(order);
        orderItemHistory.setItemType(itemType);
        orderItemHistory.setItemId(itemId);
        orderItemHistory.setOrderHistoryStatus(status);
        return orderItemHistoryRepository.save(orderItemHistory);
    }

    public List<OrderItemHistoryResponse> getOrderHistoryByOrder(String orderId) {

        orderRepository.findById(orderId)
                .orElseThrow(() -> new BadRequestException("Order not found"));

        List<OrderItemHistoryResponse> orderItemHistories =
                orderItemHistoryRepository.findAllByOrderIdOrderByCreatedAtDesc(orderId);

        orderItemHistories.forEach(orderItemHistory -> {
            List<OrderSubItemHistoryResponse> orderSubItemHistoryResponses =
                    orderSubItemHistoryMapper.getOrderSubItemHistoryResponseList(
                            orderSubItemHistoryRepository.findAllByOrderItemHistoryIdOrderByCreatedAtDesc(orderItemHistory.getId()));

            orderItemHistory.setSubItems(orderSubItemHistoryResponses);
        });

        return orderItemHistories;
    }
}

package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.OrderItemHistoryResponse;
import com.example.pos_hcsdl.dto.OrderSubItemHistoryResponse;
import com.example.pos_hcsdl.service.OrderItemHistoryService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

@Tag(name = "12. Order History Management")
@RestController
@RequestMapping("/order-history")
public class OrderHistoryController {

    @Autowired
    private OrderItemHistoryService orderItemHistoryService;

    @GetMapping("/order/{id}")
    public List<OrderItemHistoryResponse> getOrderHistoryByOrder(@PathVariable String id) {
        return orderItemHistoryService.getOrderHistoryByOrder(id);
    }
}

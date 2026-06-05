package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.*;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.service.OrderService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;

@Tag(name = "11. Order Management")
@RestController
@RequestMapping("/order")
public class OrderController {
    @Autowired
    private OrderService orderService;

    @GetMapping("/{id}")
    public OrderResponse getOrderById(@PathVariable String id) {
        return orderService.getOrderById(id);
    }

    @PostMapping("/create")
    public OrderResponse createOrder(@RequestBody OrderRequest orderRequest) {
        return orderService.createOrder(orderRequest);
    }

    @PostMapping("/add")
    public OrderResponse addOrder(@RequestBody OrderAddRequest orderAddRequest) {
        return orderService.addOrder(orderAddRequest);
    }

    @PostMapping("/payment")
    public OrderResponse payment(@RequestBody PaymentRequest paymentRequest) {
        return orderService.paymentOrder(paymentRequest);
    }

    @GetMapping("/{id}/apply-promotion")
    public OrderResponse applyPromotion(@PathVariable String id, @RequestParam String promotionId) {
        return orderService.applyPromotion(id,promotionId);
    }

    @GetMapping("/lookup")
    public LookupOrderResponse getOrderLookup(@RequestParam(required = false) String orderStatus,
                                        @RequestParam LocalDate startDate,
                                        @RequestParam LocalDate endDate,
                                        @RequestParam Integer pageSize,
                                        @RequestParam Integer pageNo,
                                        @RequestHeader(name = "X-Restaurant-Id")  String restaurantId) {
        return orderService.getOrderLookup(orderStatus, startDate, endDate, pageSize, pageNo, restaurantId);
    }
}

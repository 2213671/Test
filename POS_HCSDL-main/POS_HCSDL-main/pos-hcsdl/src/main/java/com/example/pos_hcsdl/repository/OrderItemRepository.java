package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.OrderItem;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface OrderItemRepository extends JpaRepository<OrderItem, String> {
    List<OrderItem> findAllByOrderIdOrderByCreatedAtDesc(String orderId);

    List<OrderItem> findAllByOrderIdAndItemIdOrderByCreatedAtDesc(String orderId, String itemId);
}

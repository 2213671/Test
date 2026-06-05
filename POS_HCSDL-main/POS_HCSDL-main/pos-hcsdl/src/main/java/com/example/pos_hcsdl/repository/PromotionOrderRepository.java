package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.PromotionOrder;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface PromotionOrderRepository extends JpaRepository<PromotionOrder, String> {
    Optional<PromotionOrder> findByOrder(Order order);
}

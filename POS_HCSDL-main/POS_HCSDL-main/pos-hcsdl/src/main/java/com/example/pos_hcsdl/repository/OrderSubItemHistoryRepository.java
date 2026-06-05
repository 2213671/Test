
package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.OrderItemHistory;
import com.example.pos_hcsdl.entity.OrderSubItemHistory;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface OrderSubItemHistoryRepository extends JpaRepository<OrderSubItemHistory, String> {
    List<OrderSubItemHistory> findAllByOrderItemHistoryIdOrderByCreatedAtDesc(String orderItemHistoryId);
}

package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.dto.OrderItemHistoryResponse;
import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderItemHistory;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.List;

public interface OrderItemHistoryRepository extends JpaRepository<OrderItemHistory, String> {
    @Query(value = "select oih.id, oih.name, oih.price, oih.quantity," +
            "oih.item_type,oih.order_history_status,oih.item_id,oih.request_id,oih.created_at as order_at, p.image_url as image_url from order_item_histories oih " +
            "join products p on p.id = oih.item_id " +
            "where oih.order_id = :order_id " +
            "order by oih.created_at desc", nativeQuery = true)
    List<OrderItemHistoryResponse> findAllByOrderIdOrderByCreatedAtDesc(@Param("order_id") String orderId);
}

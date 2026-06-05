
package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.OrderItem;
import com.example.pos_hcsdl.entity.OrderSubItem;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.List;

public interface OrderSubItemRepository extends JpaRepository<OrderSubItem, String> {
    @Query(value = "select * from order_sub_items where order_item_id = :order_item_id",nativeQuery = true)
    List<OrderSubItem> getSubIemByOrderItemId(@Param("order_item_id") String orderItemId);

}

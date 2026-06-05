package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.dto.OrderItemDTO;
import com.example.pos_hcsdl.dto.OrderItemResponse;
import com.example.pos_hcsdl.entity.Order;
import com.example.pos_hcsdl.entity.Shift;
import jakarta.transaction.Transactional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.jpa.repository.query.Procedure;
import org.springframework.data.repository.query.Param;

import java.math.BigDecimal;
import java.time.LocalDate;
import java.util.List;
import java.util.Optional;

public interface OrderRepository extends JpaRepository<Order, String> {
    Optional<Order> findByIdAndOrderStatus(String id, String orderStatus);

    List<Order> findAllByShift(Shift shift);

    @Query(value = "call sp_create_order(:creator_id, :table_id, :shift_id, :customer_count, :items)", nativeQuery = true)
    String createOrder(
            @Param("creator_id") String creator_id,
            @Param("table_id") String table_id,
            @Param("shift_id") String shift_id,
            @Param("customer_count") Integer customer_count,
            @Param("items") String items
    );

    @Query(value =
            "select fn_promotion_in_order(id, :promotion_id) as 'discount' " +
                    "from orders " +
                    "where id = :order_id", nativeQuery = true)
    BigDecimal getDiscountByOrder(@Param("order_id") String order_id, @Param("promotion_id") String promotion_id);

    @Query(value =
            "call sp_get_order_items_with_discount(:order_id, :promotion_id)", nativeQuery = true)
    List<OrderItemDTO> getOrderItem(@Param("order_id") String order_id, @Param("promotion_id") String promotion_id);

    @Transactional
    @Modifying
    @Query(value =
            "call sp_add_order(:order_id, :items)", nativeQuery = true)
    void addOrder(@Param("order_id") String order_id, @Param("items") String items);

    @Query(value = "select fn_check_promotion_in_order(:order_id, :promotion_id)", nativeQuery = true)
    boolean checkOrderPromotionApply(@Param("order_id") String order_id, @Param("promotion_id") String promotion_id);


    @Query(value = "SELECT o.*\n" +
            "FROM orders o\n" +
            "JOIN shifts s ON s.id = o.shift_id\n" +
            "WHERE s.restaurant_id = :restaurantId\n" +
            "  AND o.created_at >= :startDate\n" +
            "  AND o.created_at < DATE_ADD(:endDate, INTERVAL 1 DAY)\n" +
            "  AND (:orderStatus = 'ALL' OR o.order_status = :orderStatus)\n" +
            "ORDER BY o.created_at DESC\n" +
            "LIMIT :size OFFSET :offset;", nativeQuery = true)
    List<Order> getOrdersLookup(@Param("startDate") LocalDate startDate,
                                @Param("endDate") LocalDate endDate,
                                @Param("orderStatus") String orderStatus,
                                @Param("size") Integer size,
                                @Param("offset") Integer offset,
                                @Param("restaurantId") String id);

    @Query(value = "SELECT COUNT(*) AS totalElements\n" +
            "FROM orders o\n" +
            "JOIN shifts s ON s.id = o.shift_id\n" +
            "WHERE s.restaurant_id = :restaurantId\n" +
            "  AND o.created_at >= :startDate\n" +
            "  AND o.created_at < DATE_ADD(:endDate, INTERVAL 1 DAY)\n" +
            "  AND (:orderStatus = 'ALL' OR o.order_status = :orderStatus);", nativeQuery = true)
    long getTotalOrdersLookup(@Param("startDate") LocalDate startDate,
                                 @Param("endDate") LocalDate endDate,
                                 @Param("orderStatus") String orderStatus,
                                 @Param("restaurantId") String id);
}

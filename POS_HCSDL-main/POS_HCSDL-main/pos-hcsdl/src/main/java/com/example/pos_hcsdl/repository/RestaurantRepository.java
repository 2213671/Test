package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.dto.SummaryResponse;
import com.example.pos_hcsdl.dto.SummaryRestaurantResponse;
import com.example.pos_hcsdl.entity.Restaurant;
import jakarta.transaction.Transactional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.util.List;

public interface RestaurantRepository extends JpaRepository<Restaurant, String> {
    @Query(value = "select * from restaurants order by created_at desc", nativeQuery = true)
    List<Restaurant> findRestaurantsOrderByCreatedAtDesc();

    @Query(value = "with cte_restaurant_count as (\n" +
            "    select count(*) as num_res from restaurants\n" +
            ")\n" +
            "select\n" +
            "    max(cte.num_res) as num_restaurant,   -- dùng MAX() để aggregate\n" +
            "    ifnull(sum(o.customer_count), 0) as customer_count,\n" +
            "    ifnull(sum(o.total_item), 0) as total_item,\n" +
            "    ifnull(sum(o.final_amount), 0) as final_amount\n" +
            "from orders o\n" +
            "cross join cte_restaurant_count cte\n" +
            "where o.order_status = 'COMPLETED';\n", nativeQuery = true)
    SummaryResponse getSummary();

    @Query(value = "select\n" +
            "    ifnull(sum(o.customer_count), 0) as customer_count,\n" +
            "    ifnull(sum(o.total_item), 0) as total_item,\n" +
            "    ifnull(sum(o.final_amount), 0) as final_amount\n" +
            "from orders o\n" +
            " left join shifts s on o.shift_id = s.id\n" +
            "where o.order_status = 'COMPLETED' and s.restaurant_id = :restaurant_id;", nativeQuery = true)
    SummaryRestaurantResponse getSummaryRestaurant(@Param("restaurant_id") String restaurant_id);

    @Transactional
    @Query(
            value = "call sp_insert_restaurant(:name, :address, :description, :phone, :email, :imageUrl)",
            nativeQuery = true
    )
    String insertRestaurant(
            @Param("name") String name,
            @Param("address") String address,
            @Param("description") String description,
            @Param("phone") String phone,
            @Param("email") String email,
            @Param("imageUrl") String imageUrl
    );
}

package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.RestaurantTable;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface RestaurantTableRepository extends JpaRepository<RestaurantTable, String> {

    List<RestaurantTable> findAllByRestaurantOrderByIdxAsc(Restaurant restaurant);
}

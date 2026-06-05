package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Menu;
import com.example.pos_hcsdl.entity.Restaurant;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface MenuRepository extends JpaRepository<Menu, String> {
    List<Menu> findAllByRestaurant(Restaurant restaurant);
}

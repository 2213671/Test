package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Menu;
import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.entity.Restaurant;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ProductRepository extends JpaRepository<Product, String> {
    List<Product> findAllByRestaurant(Restaurant restaurant);
    List<Product> findAllByMenu(Menu menu);
}

package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Option;
import com.example.pos_hcsdl.entity.Restaurant;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface OptionRepository extends JpaRepository<Option, String> {
    List<Option> findAllByRestaurant(Restaurant restaurant);
}

package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.Topping;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ToppingRepository extends JpaRepository<Topping, String> {

    List<Topping> findAllByRestaurant(Restaurant restaurant);

}

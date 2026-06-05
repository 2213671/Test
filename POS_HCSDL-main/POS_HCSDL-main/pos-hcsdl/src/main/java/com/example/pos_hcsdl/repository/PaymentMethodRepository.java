package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.PaymentMethod;
import com.example.pos_hcsdl.entity.Restaurant;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface PaymentMethodRepository extends JpaRepository<PaymentMethod, String> {
    List<PaymentMethod> findAllByRestaurant(Restaurant restaurant);
}

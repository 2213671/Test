package com.example.pos_hcsdl.service;

import com.example.pos_hcsdl.dto.ToppingRequest;
import com.example.pos_hcsdl.dto.ToppingResponse;
import com.example.pos_hcsdl.entity.Restaurant;
import com.example.pos_hcsdl.entity.Topping;
import com.example.pos_hcsdl.exception.BadRequestException;
import com.example.pos_hcsdl.mapper.ToppingMapper;
import com.example.pos_hcsdl.repository.RestaurantRepository;
import com.example.pos_hcsdl.repository.ToppingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class ToppingService {

    @Autowired
    private ToppingRepository toppingRepository;

    @Autowired
    private RestaurantRepository restaurantRepository;

    @Autowired
    private ToppingMapper toppingMapper;

    public ToppingResponse createTopping(ToppingRequest toppingRequest, String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));

        Topping topping = toppingMapper.getTopping(toppingRequest);
        topping.setRestaurant(restaurant);
        topping.setStatus("ACTIVE");

        return toppingMapper.getToppingResponse(toppingRepository.save(topping));
    }

    public List<ToppingResponse> getToppings(String restaurantId) {
        Restaurant restaurant = restaurantRepository.findById(restaurantId)
                .orElseThrow(() -> new BadRequestException("restaurant not found"));
        return toppingMapper.getToppingResponseList(toppingRepository.findAllByRestaurant(restaurant));
    }

    public ToppingResponse updateTopping( String toppingId, ToppingRequest toppingRequest) {
        Topping topping = toppingRepository.findById(toppingId)
                .orElseThrow(() -> new BadRequestException("topping not found"));
        topping.setPrice(toppingRequest.getPrice());
        topping.setName(toppingRequest.getName());
        topping.setMaxQuantity(toppingRequest.getMaxQuantity());
        return toppingMapper.getToppingResponse(toppingRepository.save(topping));
    }
}

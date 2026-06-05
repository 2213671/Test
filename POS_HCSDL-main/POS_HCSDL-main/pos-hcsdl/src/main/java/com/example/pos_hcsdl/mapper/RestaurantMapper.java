package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.RestaurantResponse;
import com.example.pos_hcsdl.dto.ToppingRequest;
import com.example.pos_hcsdl.entity.Restaurant;
import org.mapstruct.Mapper;

import java.util.List;

@Mapper(componentModel = "spring")
public interface RestaurantMapper {

    RestaurantResponse getRestaurantResponse(Restaurant restaurant);

    Restaurant getRestaurant(ToppingRequest toppingRequest);

    List<RestaurantResponse> getRestaurantResponseList(List<Restaurant> restaurants);
}

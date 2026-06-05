package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.RestaurantRequest;
import com.example.pos_hcsdl.dto.RestaurantResponse;
import com.example.pos_hcsdl.entity.Restaurant;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface RestaurantCreateMapper extends BaseMapper<Restaurant, RestaurantRequest, RestaurantResponse> {
}

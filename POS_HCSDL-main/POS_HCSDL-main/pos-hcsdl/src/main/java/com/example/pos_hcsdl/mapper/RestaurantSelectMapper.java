package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.RestaurantSelect;
import com.example.pos_hcsdl.entity.Restaurant;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface RestaurantSelectMapper extends BaseResponseMapper<Restaurant, RestaurantSelect> {
}

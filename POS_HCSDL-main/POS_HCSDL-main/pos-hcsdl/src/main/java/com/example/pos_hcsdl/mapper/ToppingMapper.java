package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.ToppingRequest;
import com.example.pos_hcsdl.dto.ToppingResponse;
import com.example.pos_hcsdl.entity.Topping;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface ToppingMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    ToppingResponse getToppingResponse(Topping topping);

    Topping getTopping(ToppingRequest toppingRequest);

    List<ToppingResponse> getToppingResponseList(List<Topping> options);
}

package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.TableRequest;
import com.example.pos_hcsdl.dto.TableResponse;
import com.example.pos_hcsdl.entity.RestaurantTable;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface TableMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    TableResponse getTableResponse(RestaurantTable table);

    RestaurantTable getTable(TableRequest tableRequest);

    List<TableResponse> getTableResponseList(List<RestaurantTable> tables);
}

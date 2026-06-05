package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.CurrentUser;
import com.example.pos_hcsdl.dto.StaffRequest;
import com.example.pos_hcsdl.dto.StaffResponse;
import com.example.pos_hcsdl.entity.User;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface UserMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    @Mapping(target = "roleName", source = "role.roleName")
    CurrentUser getCurrentUser(User user);

    @Mapping(target = "password", ignore = true)
    User getUser(StaffRequest staffRequest);

    @Mapping(target = "roleName", source = "role.roleName")
    StaffResponse getStaffResponse(User user);

    List<StaffResponse> getStaffResponseList(List<User> users);
}
